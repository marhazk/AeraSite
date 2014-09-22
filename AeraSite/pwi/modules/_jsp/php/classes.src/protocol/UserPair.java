/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class UserPair extends Rpc.Data
/*    */ {
/*    */   public UserID key;
/*    */   public User value;
/*    */ 
/*    */   public UserPair()
/*    */   {
/* 15 */     this.key = new UserID();
/* 16 */     this.value = new User();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 21 */     os.marshal(this.key);
/* 22 */     os.marshal(this.value);
/* 23 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 28 */     os.unmarshal(this.key);
/* 29 */     os.unmarshal(this.value);
/* 30 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 37 */       UserPair o = (UserPair)super.clone();
/* 38 */       o.key = ((UserID)this.key.clone());
/* 39 */       o.value = ((User)this.value.clone());
/* 40 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 43 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.UserPair
 * JD-Core Version:    0.6.2
 */