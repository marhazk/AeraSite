/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class UserRes extends Rpc.Data
/*    */ {
/*    */   public int retcode;
/*    */   public User value;
/*    */ 
/*    */   public UserRes()
/*    */   {
/* 15 */     this.value = new User();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 20 */     os.marshal(this.retcode);
/* 21 */     os.marshal(this.value);
/* 22 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 27 */     this.retcode = os.unmarshal_int();
/* 28 */     os.unmarshal(this.value);
/* 29 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 36 */       UserRes o = (UserRes)super.clone();
/* 37 */       o.value = ((User)this.value.clone());
/* 38 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 41 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.UserRes
 * JD-Core Version:    0.6.2
 */