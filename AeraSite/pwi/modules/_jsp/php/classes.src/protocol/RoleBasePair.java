/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class RoleBasePair extends Rpc.Data
/*    */ {
/*    */   public RoleId key;
/*    */   public GRoleBase value;
/*    */ 
/*    */   public RoleBasePair()
/*    */   {
/* 15 */     this.key = new RoleId();
/* 16 */     this.value = new GRoleBase();
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
/* 37 */       RoleBasePair o = (RoleBasePair)super.clone();
/* 38 */       o.key = ((RoleId)this.key.clone());
/* 39 */       o.value = ((GRoleBase)this.value.clone());
/* 40 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 43 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.RoleBasePair
 * JD-Core Version:    0.6.2
 */