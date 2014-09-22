/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class RoleStorehouseRes extends Rpc.Data
/*    */ {
/*    */   public int retcode;
/*    */   public GRoleStorehouse value;
/*    */ 
/*    */   public RoleStorehouseRes()
/*    */   {
/* 15 */     this.value = new GRoleStorehouse();
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
/* 36 */       RoleStorehouseRes o = (RoleStorehouseRes)super.clone();
/* 37 */       o.value = ((GRoleStorehouse)this.value.clone());
/* 38 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 41 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.RoleStorehouseRes
 * JD-Core Version:    0.6.2
 */